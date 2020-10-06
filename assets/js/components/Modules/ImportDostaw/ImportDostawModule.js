import React, {Component} from 'react';
import WyszukiwanieKierowcyDatalist from "../WyszukanieKierowcy/WyszukiwanieKierowcyDatalist";
import FileDropzone from "./FileDropzone/FileDropzone";

class ImportDostawModule extends Component {
    constructor() {
        super();

        this.state = {
            name: "",
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

    handleImportFile() {
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
                        <form onSubmit={this.handleSearchDriver}>
                            <div className={'import-dostaw-wrapper'}>
                                <div className={"row margin-0 import-dostaw-item"}>
                                    <div className={"col text-center import-dostaw-box"}>
                                        <label>Upload pliku</label>
                                        <FileDropzone/>
                                    </div>
                                    <div className={"col text-center customize-button"}>
                                        <button
                                            type={"button"}
                                            className={"btn btn-primary"}
                                            onClick={this.handleSearchDriver}
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