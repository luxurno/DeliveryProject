import React, {Component} from 'react';
import DriverSearchDatalist from "./Datalist/DriverSearchDatalist";

export default class DriverSearchComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: "",
            showConfig: false,
            showAvailable: true,
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSearchDriver = this.handleSearchDriver.bind(this);
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
    }

    handleSearchDriver(event) {
        event.preventDefault();

        this.setState({ showConfig: true});
        this.props.callbackFromParent(this.state);
    }

    availableCallback = (dataFromChild) => {
        this.setState({
            showAvailable: !dataFromChild.available,
        });
        // TODO Remove bug with missing one action (letter)
    };

    render() {
        return(
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
                                    <label>Imię i nazwisko</label>
                                    <input
                                        type={"text"}
                                        name={"name"}
                                        list={"drivers"}
                                        value={this.state.value}
                                        placeholder={"np. Karol Kowalski"}
                                        onChange={this.handleChange}
                                    />
                                    <DriverSearchDatalist available={this.props.data.available} callback={this.availableCallback} />
                                </div>
                                <div className={"col text-center customize-button"}>
                                    <button
                                        disabled={!this.state.showAvailable}
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
