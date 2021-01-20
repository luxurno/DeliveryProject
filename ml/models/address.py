import os

os.environ["TF_CPP_MIN_LOG_LEVEL"] = "2"
import tensorflow as tf
import pandas as pd
import tensorflow_datasets as tfds
from tensorflow import keras
from tensorflow.keras import layers
import pickle

tokenizer = tfds.deprecated.text.Tokenizer()

warehousePackages = tf.data.TextLineDataset("../resources/warehousePackagesDb.csv")
dataset = tf.data.Dataset.zip(warehousePackages)

# for warehousePackage in dataset.skip(1):
#     print(tokenizer.tokenize(warehousePackage.numpy().decode("UTF-8")))

# TODO:
# 1. vocabulary (for each language)
# 2. tokenize and numericalize words
# 3. padded_batch, create model


# import sys
#
# sys.exit()


## Example if you have multiple files
file_names = ["../resources/test_example5.csv", "../resources/test_example6.csv", "../resources/test_example7.csv", "../resources/test_example8.csv", "../resources/test_example9.csv"]
dataset = tf.data.TextLineDataset(file_names)

dataset1 = tf.data.TextLineDataset("../resources/test_example5.csv").skip(1)  # .map(preprocess1)
dataset2 = tf.data.TextLineDataset("../resources/test_example6.csv").skip(1)  # .map(preprocess1)
dataset3 = tf.data.TextLineDataset("../resources/test_example7.csv").skip(1)  # .map(preprocess1)
dataset4 = tf.data.TextLineDataset("../resources/test_example8.csv").skip(1)  # .map(preprocess1)
dataset5 = tf.data.TextLineDataset("../resources/test_example9.csv").skip(1)  # .map(preprocess1)

dataset = dataset1.concatenate(dataset2).concatenate(dataset3).concatenate(dataset4).concatenate(dataset5)

# for line in dataset:
#     print(line)


# import sys
#
# sys.exit()


def filter_train(line):
    split_line = tf.strings.split(line, ",", maxsplit=4)
    dataset_belonging = split_line[1]  # train, test

    return (
        True if dataset_belonging == "train" else False
    )


def filter_test(line):
    split_line = tf.strings.split(line, ",", maxsplit=4)
    dataset_belonging = split_line[1]  # train, test

    return (
        True if dataset_belonging == "test" else False
    )


ds_train = tf.data.TextLineDataset("../resources/driverHistory_1.csv").filter(filter_train)
ds_test = tf.data.TextLineDataset("../resources/driverHistory_1.csv").filter(filter_test)

# TODO:
# 1. Create vocabulary
# 2. Numericalize text str -> indices (TokenTextEncoder)
# 3. Pad the batches so we can send in to an RNN for example

tokenizer = tfds.deprecated.text.Tokenizer()
# 'i love banana' -> ['i', 'love', 'banana'] -> [0, 1, 2]


def build_vocabulary(ds_train, threshold=50):
    """ Build a vocabulary """
    frequencies = {}
    vocabulary = set()
    vocabulary.update(["sostoken"])
    vocabulary.update(["eostoken"])

    for line in ds_train.skip(1):
        split_line = tf.strings.split(line, ",", maxsplit=4)
        review = split_line[4]
        tokenized_text = tokenizer.tokenize(review.numpy().lower())

        for word in tokenized_text:
            if word not in frequencies:
                frequencies[word] = 1

            else:
                frequencies[word] += 1

            # if we've reached the threshold
            if frequencies[word] == threshold:
                vocabulary.update(tokenized_text)

    return vocabulary


# Build vocabulary and save it to vocabulary.obj
vocabulary = build_vocabulary(ds_train)
vocab_file = open("vocabulary.obj", "wb")
pickle.dump(vocabulary, vocab_file)

# Loading the vocabulary
# vocab_file = open("vocabulary.obj", "rb")
# vocabulary = pickle.load(vocab_file)

encoder = tfds.deprecated.text.TokenTextEncoder(
    list(vocabulary), oov_token="<UNK>", lowercase=True, tokenizer=tokenizer,
)


def my_encoder(text_tensor, label):
    encoded_text = encoder.encode(text_tensor.numpy())
    return encoded_text, label


def encode_map_fn(line):
    split_line = tf.strings.split(line, ",", maxsplit=4)
    label_str = split_line[2]  # neg, pos
    review = "sostoken " + split_line[4] + " eostoken"
    label = 1 if label_str == "pos" else 0

    (encoded_text, label) = tf.py_function(
        my_encoder, inp=[review, label], Tout=(tf.int64, tf.int32),
    )

    encoded_text.set_shape([None])
    label.set_shape([])
    return encoded_text, label


AUTOTUNE = tf.data.experimental.AUTOTUNE
ds_train = ds_train.map(encode_map_fn, num_parallel_calls=AUTOTUNE).cache()
ds_train = ds_train.shuffle(25000)
ds_train = ds_train.padded_batch(32, padded_shapes=([None], ()))

ds_test = ds_test.map(encode_map_fn)
ds_test = ds_test.padded_batch(32, padded_shapes=([None], ()))

model = keras.Sequential(
    [
        layers.Masking(mask_value=0),
        layers.Embedding(input_dim=len(vocabulary) + 2, output_dim=32,),
        layers.GlobalAveragePooling1D(),
        layers.Dense(64, activation="relu"),
        layers.Dense(1),
    ]
)

model.compile(
    loss=keras.losses.BinaryCrossentropy(from_logits=True),
    optimizer=keras.optimizers.Adam(3e-4, clipnorm=1),
    metrics=["accuracy"],
)

model.fit(ds_train, epochs=15, verbose=2)
model.evaluate(ds_test)

### Workaround with predicition
import sys

ds_predict = tf.data.TextLineDataset("../resources/driverHistory_2.csv").skip(1).filter(filter_test)

# print(ds_predict)
# sys.exit()

ds_predict = ds_predict.map(encode_map_fn)
ds_predict = ds_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = model.predict(ds_predict)

print(predictions)
prob = tf.nn.sigmoid(predictions[0])

print(
    "This particular pet had a %.1f percent probability "
    "of getting adopted." % (100 * prob)
)

# for predict_line in ds_predict:
#     split_line = tf.strings.split(predict_line, ",", maxsplit=4)
#
#     # predict_line = encode_map_fn(predict_line)
#     # sample = {
#     #     split_line[4]
#     # }
#     test = tf.convert_to_tensor(predict_line)
#
#     predictions = model.predict(test)
#     prob = tf.nn.sigmoid(predictions[0])
#
#     print(
#         "This particular pet had a %.1f percent probability "
#         "of getting adopted." % (100 * prob)
#     )
#
#     print(predict_line)
#     print(split_line[4])
#     sys.exit()
#
# input_dict = tf.convert_to_tensor(vocabulary)
#
# import sys
# sys.exit()

# for predict in ds_predict:
    # predict = tf.Tensor(b'11,train,pos,e1413d4935a9f00467aed8dd245efe978ab73fed,"Polska \xc5\x9al\xc4\x85sk tarnog\xc3\xb3rski \xc5\x9awierklaniec Nak\xc5\x82o \xc5\x9al\xc4\x85skie 42-620 Gaw\xc4\x99dy 4"', shape=(), dtype=string)
    # vocabulary = build_vocabulary(predict)
    # print(vocabulary)
    # import sys
    # sys.exit()
    #
    # input_dict = tf.convert_to_tensor(predict)
    # predictions = model.predict(input_dict)
    # prob = tf.nn.sigmoid(predictions[0])
    # print(
    #     "This particular pet had a %.1f percent probability "
    #     "of getting adopted." % (100 * prob)
    # )

