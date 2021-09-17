import React, {Component} from 'react';
import axios from 'axios';
import FileDropzone from "./FileDropzone/FileDropzone";
import ScreenPopup from "../../Core/Popup/Screen.popup";
import SpinnerPage from "../../Spinner/SpinnerPage";

class ImportDeliveryComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: "",
            status: null,
            importData: null,
            showConfig: false,
            isLoading: false
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleImportFile = this.handleImportFile.bind(this);
    }

    async handleChange(event) {
        await this.setState({
            [event.target.name]: event.target.value
        });
        await this.props.callbackFromParent(this.state);
    }

    importDataCallback = async (data) => {
        await this.setState({
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
                {withCredentials: true}
            )
            .then(response => {
                this.setState({
                    isLoading: false,
                    status: "Pomyślnie przekazano plik",
                });

                console.log('ok');
                console.log(response);
            })
            .catch(error => {
                this.setState({
                    isLoading: false,
                    status: "Coś poszło nie tak",
                });
                console.log('error');
                console.log(error);
            });
        event.preventDefault();
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
                        <form onSubmit={(e) => this.handleImportFile(e)}>
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
                                            onClick={(e) => this.handleImportFile(e)}
                                        >{this.props.data.button}</button>
                                    </div>
                                </div>
                                <div className={"import-dostaw-loader"}>
                                    <SpinnerPage isLoading={this.state.isLoading}/>
                                </div>
                            </div>
                        </form>
                        <ScreenPopup status={this.state.status}/>
                    </div>
                </div>
            </div>
        );
    }
}
export default ImportDeliveryComponent;
