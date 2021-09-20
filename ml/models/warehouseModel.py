# Step 1 - Read warehouse_packagesDB.csv
# Step 2 - Build Test Sets
# Step 3 - Create Filter methods datasets
# Step 4 - Building vocabulary datasets
# Step 5 - Save vocabulary dataset
# Step 6 - Create encoder
# Step 7 - Create encoder function
# Step 8 - Create encoder mapping function
# Step 9 - Create training model
# Step 10 - Create testing model
# Step 11 - Declare model
# Step 12 - Compile, train model
# Step 13 - Predict on Cities Export
# Step 14 - Save Predicition output file

import os
import constants.constants as constant
os.environ["TF_CPP_MIN_LOG_LEVEL"] = "2"
import tensorflow
import pandas as pd
import tensorflow_datasets as tensorflow_ds
from tensorflow import keras
from tensorflow.keras import layers
import pickle
import csv

tokenizer = tensorflow_ds.deprecated.text.Tokenizer()

# Step 1
warehouse_packages = tensorflow.data.TextLineDataset(constant.RESOURCES_FOLDER + constant.WAREHOUSE_DB_FILE_NAME)
dataset = tensorflow.data.Dataset.zip(warehouse_packages)

train_file_names = [
    constant.TEST_1,
    constant.TEST_2,
    constant.TEST_3,
    constant.TEST_4,
    constant.TEST_5,
]

# Step 2
train_dataset_1 = tensorflow.data.TextLineDataset(train_file_names[0]).skip(1)
train_dataset_2 = tensorflow.data.TextLineDataset(train_file_names[1]).skip(1)
train_dataset_3 = tensorflow.data.TextLineDataset(train_file_names[2]).skip(1)
train_dataset_4 = tensorflow.data.TextLineDataset(train_file_names[3]).skip(1)
train_dataset_5 = tensorflow.data.TextLineDataset(train_file_names[4]).skip(1)

dataset = train_dataset_1.concatenate(train_dataset_2).concatenate(train_dataset_3).concatenate(train_dataset_4).concatenate(train_dataset_5)

# Step 3
def filter_training_data(line):
    split_line = tensorflow.strings.split(line, ",", maxsplit = constant.MAXSPLITS)
    dataset = split_line[1] # type of data (train, test)

    if dataset == "train":
        return True

    return False

# Step 3
def filter_testing_data(row):
    split_line = tensorflow.strings.split(row, ",", maxsplit = constant.MAXSPLITS)
    dataset = split_line[1]

    if dataset == "test":
        return True

    return False

train_dataset = tensorflow.data.TextLineDataset(constant.TRAIN_DATASET_CITY_FILE_NAME).filter(filter_training_data)

test_dataset = tensorflow.data.TextLineDataset(constant.TRAIN_DATASET_CITY_FILE_NAME).filter(filter_testing_data)

# Step 4
tokenizer = tensorflow_ds.deprecated.text.Tokenizer()

def building_vocabulary(train_dataset, threshold = 50):
    frequencies = {}
    vocabulary = set()
    vocabulary.update([constant.START_TOKEN])
    vocabulary.update([constant.END_TOKEN])

    for row in train_dataset.skip(1):
        split_line = tensorflow.strings.split(row, ",", maxsplit = constant.MAXSPLITS)
        address = split_line[4]
        tokenized = tokenizer.tokenize(address.numpy().lower())

        for word in tokenized:
            if word in frequencies:
                frequencies[word] += 1

            else:
                frequencies[word] = 1

            if frequencies[word] == threshold:
                vocabulary.update(tokenized)

    return vocabulary

# Step 5
vocabulary = building_vocabulary(train_dataset)
vocab_file = open(constant.VOCABULARY_FILE_NAME, "wb")
pickle.dump(vocabulary, vocab_file)

# Step 6
encoder = tensorflow_ds.deprecated.text.TokenTextEncoder(
    list(vocabulary), oov_token="<UNK>", lowercase=True, tokenizer=tokenizer
)

# Step 7
def encoder_function(text_tensorflow, label):
    encoded = encoder.encode(text_tensorflow.numpy())
    return encoded, label

# Step 8
def encoder_mapping_function(row):
    split_line = tensorflow.strings.split(row, ",", maxsplit = constant.MAXSPLITS)
    label_string = split_line[2]
    address = constant.START_TOKEN + split_line[4] + " " + constant.END_TOKEN

    label = 0
    if (label_string == "pos"):
        label = 1

    (encoded_text, label) = tensorflow.py_function(
        encoder_function, inp = [address, label], Tout=(tensorflow.int64, tensorflow.int32)
    )

    encoded_text.set_shape([None])
    label.set_shape([])

    return encoded_text, label

# Step 9
AUTOTUNE = tensorflow.data.experimental.AUTOTUNE
train_dataset = train_dataset.map(encoder_mapping_function, num_parallel_calls=AUTOTUNE).cache()
train_dataset = train_dataset.shuffle(25000)
train_dataset = train_dataset.padded_batch(32, padded_shapes=([None], ()))

# Step 10
test_dataset = test_dataset.map(encoder_mapping_function)
test_dataset = test_dataset.padded_batch(32, padded_shapes=([None], ()))

# Step 11
warehouse_model = keras.Sequential(
    [
        layers.Masking(mask_value = 0),
        layers.Embedding(input_dim = len(vocabulary) + 2, output_dim = 32,),
        layers.GlobalAveragePooling1D(),
        layers.Dense(64, activation="relu"),
        layers.Dense(1),
    ]
)

# Step 12
warehouse_model.compile(
    loss = keras.losses.BinaryCrossentropy(from_logits = True),
    optimizer = keras.optimizers.Adam(3e-4, clipnorm = 1),
    metrics = ["accuracy"],
)

warehouse_model.fit(train_dataset, epochs = constant.EPOCHS, verbose=2)
warehouse_model.evaluate(test_dataset)

# Step 14
file = open(constant.PREDICTION_FILE_NAME, 'w', newline='')
fieldnames = ['city', 'prediction']
writer = csv.DictWriter(file, fieldnames=fieldnames)
writer.writeheader()

### City 1
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_1).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_1, 'prediction': ("%.1f" % (100 * prob))})

### City 2
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_2).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_2, 'prediction': ("%.1f" % (100 * prob))})

### City 3
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_3).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_3, 'prediction': ("%.1f" % (100 * prob))})

### City 4
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_4).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_4, 'prediction': ("%.1f" % (100 * prob))})

### City 5
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_5).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_5, 'prediction': ("%.1f" % (100 * prob))})

### City 6
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_6).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_6, 'prediction': ("%.1f" % (100 * prob))})

### City 7
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_7).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_7, 'prediction': ("%.1f" % (100 * prob))})

### City 8
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_8).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_8, 'prediction': ("%.1f" % (100 * prob))})

### City 9
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_9).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_9, 'prediction': ("%.1f" % (100 * prob))})

### City 10
dataset_predict = tensorflow.data.TextLineDataset(constant.PREDICTION_CITY_10).skip(1)
dataset_predict = dataset_predict.map(encoder_mapping_function)
dataset_predict = dataset_predict.padded_batch(32, padded_shapes=([None], ()))

predictions = warehouse_model.predict(dataset_predict)
prob = tensorflow.nn.sigmoid(predictions[0])

writer.writerow({'city': constant.CITY_10, 'prediction': ("%.1f" % (100 * prob))})
