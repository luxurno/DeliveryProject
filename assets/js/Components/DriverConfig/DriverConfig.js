import React, { Component } from 'react';
import axios from 'axios';
import { OnKeyPressService } from '../../Core/Service/OnKeyPress.service';
import { KeyEnum } from "../../Core/Service/Enum/KeyEnum";
import {HeadersEnum} from "../../Core/Text/Enum/Headers.enum";
import {DriverNameFilter} from "../../Core/Filter/DriverName.filter";

export default class DriverConfig extends Component {
    onKeyPressService$: OnKeyPressService = new OnKeyPressService();
    driverNameFilter$: DriverNameFilter = new DriverNameFilter();

    constructor(props) {
        super(props);

        this.state = {
            name: HeadersEnum.DRIVER_CONFIG,
            height: "",
            width: "",
            capacity: "",
            adr: "",
            invalidHeight: true,
            invalidWidth: true,
            invalidCapacity: true,
            invalidAdr: true,
        };

        this.validateData = this.validateData.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmitKeyDown = this.handleSubmitKeyDown.bind(this);
        this.handleSaveConfiguration = this.handleSaveConfiguration.bind(this);
    }

    handleSubmitKeyDown(event: KeyboardEvent): void {
        if (this.onKeyPressService$.isKeyPressed(event, KeyEnum.ENTER)) {
            this.handleSaveConfiguration();
        }
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
        this.validateData(event);
    }

    validateData(event) {
        let value = event.target.value;

        switch(event.target.name) {
            case "height":
                value = parseInt(event.target.value);
                if (Number.isInteger(value)) {
                    if (value.valueOf() >= 150 && value.valueOf() <= 350) {
                        this.setState({invalidHeight: false});
                    } else {
                        this.setState({invalidHeight: true});
                    }
                } else {
                    this.setState({invalidHeight: true});
                }
                break;
            case "width":
                value = parseInt(event.target.value);
                if (Number.isInteger(value)) {
                    if (value.valueOf() >= 150 && value.valueOf() <= 300) {
                        this.setState({invalidWidth: false});
                    } else {
                        this.setState({invalidWidth: true});
                    }
                } else {
                    this.setState({invalidWidth: true});
                }
                //this.state.invalidWidth = !Number.isInteger(parseInt(value));
                break;
            case "capacity":
                value = parseInt(event.target.value);
                if (Number.isInteger(value)) {
                    if (value.valueOf() >= 500 && value.valueOf() <= 1900) {
                        this.setState({invalidCapacity: false});
                    } else {
                        this.setState({invalidCapacity: true});
                    }
                } else {
                    this.setState({invalidCapacity: true});
                }
                break;
            case "adr":
                if (['tak', 'nie'].includes(value.toLowerCase())) {
                    this.setState({invalidAdr: false});
                } else {
                    this.setState({invalidAdr: true});
                }
                break;
        }
    }

    handleSaveConfiguration(event) {
        const { height, width, capacity, adr } = this.state;

        const { name } = this.props.data;
        let id = this.driverNameFilter$.getDriverId(name);

        axios
            .post(
                process.env.APP_DOMAIN + '/api/driver/save',
                {
                    config: {
                        id: id,
                        height: height,
                        width: width,
                        capacity: capacity,
                        adr: adr,
                    }
                },
                { withCredentials: true }
            )
            .then(response => {
                if (response.status === 204) {
                    window.location = '/settings'
                }
            })
            .catch(error => {
                this.state.validateErrorMessage = "Taki kierowca nie istnieje";
            });
        event.preventDefault();
    }

    render() {
        let { name, showConfig } = this.props.data;
        let displayStyle = {};

        if (showConfig === false) {
            displayStyle = {
                display: "none",
            };
        }

        return(
            <div className={"konfiguracja-kierowcy-container"} style={displayStyle}>
                <div className={"d-flex justify-content-center"}>
                    <div className={"modules-header-text"}>
                        {this.state.name}
                    </div>
                </div>
                <div className={"d-flex justify-content-center"}>
                    <div className={"konfiguracja-kierowcy-form d-flex"}>
                        <form
                            onKeyDown={(e) => this.handleSubmitKeyDown(e)}
                            onSubmit={this.handleSaveConfiguration}
                        >
                            <div className={"row margin-0 vertical-center " +
                            "modules-header-text-form konfiguracja-kierowcy-name " +
                            "konfiguracja-kierowcy-row"}>
                                {name}
                            </div>
                            <div className={"row margin-0 vertical-center konfiguracja-kierowcy-row"}>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Wysokość Samochodu *</label>
                                    <input
                                        type={"text"}
                                        name={"height"}
                                        value={this.state.height}
                                        placeholder={"np. 220cm"}
                                        onChange={this.handleChange}
                                    />
                                    <label style={{display: this.state.invalidHeight ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                                </div>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Szerokość Samochod *</label>
                                    <input
                                        type={"text"}
                                        name={"width"}
                                        value={this.state.width}
                                        placeholder={"np. 270cm"}
                                        onChange={this.handleChange}
                                    />
                                    <label style={{display: this.state.invalidWidth ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                                </div>
                            </div>
                            <div className={"row margin-0 vertical-center konfiguracja-kierowcy-row"}>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Ładowność Samochodu *</label>
                                    <input
                                        type={"text"}
                                        name={"capacity"}
                                        value={this.state.capacity}
                                        placeholder={"np. 1300kg"}
                                        onChange={this.handleChange}
                                    />
                                    <label style={{display: this.state.invalidCapacity ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                                </div>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Uprawnienia ADR *</label>
                                    <input
                                        type={"text"}
                                        name={"adr"}
                                        value={this.state.adr}
                                        placeholder={"np. TAK/NIE"}
                                        onChange={this.handleChange}
                                    />
                                    <label style={{display: this.state.invalidAdr ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                                </div>
                            </div>
                            <div className={"row margin-0 vertical-center konfiguracja-kierowcy-row"}>
                                <div className={"col text-center customize-button"}>
                                    <button
                                        disabled={this.state.invalidHeight || this.state.invalidWidth || this.state.invalidCapacity || this.state.invalidAdr}
                                        type={"button"}
                                        className={"btn btn-primary"}
                                        onClick={this.handleSaveConfiguration}
                                        >Zapisz</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}
