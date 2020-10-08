import React, { Component } from 'react'
import { CSVReader } from 'react-papaparse'

class FileDropzone extends Component {
    constructor(props) {
        super(props);
    }

    handleOnDrop = (data) => {
        console.log('---------------------------');
        console.log(data);
        console.log('---------------------------');
        this.props.callbackImportFile(data);
    };

    handleOnError = (err, file, inputElem, reason) => {
        console.log(err);
    };

    handleOnRemoveFile = (data) => {
        console.log('---------------------------');
        console.log(data);
        console.log('---------------------------');
    };

    render() {
        return (
            <CSVReader
                onDrop={this.handleOnDrop}
                onError={this.handleOnError}
                addRemoveButton
                onRemoveFile={this.handleOnRemoveFile}
            >
                <span>Drop CSV file.</span>
            </CSVReader>
        )
    }
}
export default FileDropzone;