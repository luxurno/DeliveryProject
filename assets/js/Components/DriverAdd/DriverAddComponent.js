import React, {Component} from 'react';
import axios from 'axios';
import {StorageService} from "../../Core/Service/Storage.service";

export default class DriverAddComponent extends Component {
    storageService$: StorageService = new StorageService();

    constructor(props) {
        super(props);

        this.state = {
            name: "",
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
        let userId = this.storageService$.getCurrentUserId();

        this.props.callbackFromParent(this.state);

        axios
            .post(
                process.env.APP_DOMAIN + '/api/driver',
                {
                    userId: userId,
                    name: this.state.name,
                }
            )
            .then(response => {
                if (response.status === 204) {
                    window.location = '/settings'
                }
            });
    }

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
                                </div>
                                <div className={"col text-center customize-button"}>
                                    <button
                                        type={"button"}
                                        className={"btn btn-add"}
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
