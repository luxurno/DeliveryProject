import React, {Component} from 'react';
import axios from 'axios';
import FileDropzone from "./FileDropzone/FileDropzone";

class ImportDostawModule extends Component {
    constructor() {
        super();

        this.state = {
            name: "",
            importData: null,
            showConfig: false,
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleImportFile = this.handleImportFile.bind(this);
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
        this.props.callbackFromParent(this.state);
    }

    importDataCallback = (data) => {
        this.setState({
            importData: data,
        });
    };

    handleImportFile(event) {
        let data = this.state.importData;

        axios
            .post(
                process.env.APP_DOMAIN + "/api/import-delivery/save",
                {
                    data: data,
                },
                { withCredentials: true }
            )
            .then(response => {
                console.log('ok');
                console.log(response);
            })
            .catch(error => {
                console.log('error');
                console.log(error);
            });
        console.log('handluje! XD');
    }

    render() {
        return (
            <div className={"import-dostaw-container"}>
                <div className={"d-flex justify-content-center"}>
                    <div className={"modules-header-text"}>
                        {this.props.data.title}
                    </div>
                </div>
                <div className={"d-flex justify-content-center"}>
                    <div className={"import-dostaw-form d-flex"}>
                        <form onSubmit={this.handleImportFile}>
                            <div className={'import-dostaw-wrapper'}>
                                <div className={"row margin-0 import-dostaw-item"}>
                                    <div className={"col text-center import-dostaw-box"}>
                                        <label>Upload pliku</label>
                                        <FileDropzone callbackImportFile={this.importDataCallback}/>
                                    </div>
                                    <div className={"col text-center customize-button"}>
                                        <button
                                            type={"button"}
                                            className={"btn btn-primary"}
                                            onClick={this.handleImportFile}
                                        >{this.props.data.button}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}
export default ImportDostawModule;