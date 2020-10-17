import React, {Component} from 'react';
import axios from 'axios';
import FileDropzone from "./FileDropzone/FileDropzone";
import SpinnerPage from "./../../Spinner/SpinnerPage";

class ImportDostawModule extends Component {
    constructor() {
        super();

        this.state = {
            name: "",
            importData: null,
            showConfig: false,
            isLoading: false
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
        this.setState({isLoading: true});

        axios
            .post(
                process.env.APP_DOMAIN + '/api/import-delivery/save',
                {
                    data: data,
                },
                { withCredentials: true }
            )
            .then(response => {
                this.setState({isLoading: false});
                console.log('ok');
                console.log(response);
            })
            .catch(error => {
                this.setState({isLoading: false});
                console.log('error');
                console.log(error);
            });
    }

    render() {
        let isLoading = this.state.isLoading;

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
                                <div className={"row margin-0 import-dostaw-item"}
                                     style={{display: !isLoading ? 'flex' : 'none' }}
                                >
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
                            <div className={"import-dostaw-loader"}>
                                <SpinnerPage isLoading={this.state.isLoading}/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}
export default ImportDostawModule;
