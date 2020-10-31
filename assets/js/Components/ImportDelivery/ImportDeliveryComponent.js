import React, {Component} from 'react';
import axios from 'axios';
import FileDropzone from "./FileDropzone/FileDropzone";
import SpinnerPage from "../../Spinner/SpinnerPage";

class ImportDeliveryComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: "",
            importData: null,
            importDate: null,
            showConfig: false,
            isLoading: false
        };

        let now = new Date();
        this.state.importDate = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();

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
        let importDate = this.state.importDate;

        this.setState({isLoading: true});

        axios
            .post(
                process.env.APP_DOMAIN + '/api/import-delivery/save',
                {
                    data: data,
                    importDate: importDate,
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
export default ImportDeliveryComponent;
