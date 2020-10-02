import React, {Component} from 'react';
import WyszukiwanieKierowcyDatalist from "../WyszukanieKierowcy/WyszukiwanieKierowcyDatalist";
import FileDropzone from "./FileDropzone/FileDropzone";

class ImportPrzesylekModule extends Component {
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
            <div className={"wyszukiwanie-kierowcy-container"}>
                <div className={"d-flex justify-content-center"}>
                    <div className={"modules-header-text"}>
                        {this.props.data.title}
                    </div>
                </div>
                <div className={"d-flex justify-content-center"}>
                    <div className={"wyszukiwanie-kierowcy-form d-flex"}>
                        <form onSubmit={this.handleSearchDriver}>
                            <div className={"row margin-0 vertical-center"}>
                                <div className={"col text-center blue-outline-box"}>
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
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}
export default ImportPrzesylekModule;