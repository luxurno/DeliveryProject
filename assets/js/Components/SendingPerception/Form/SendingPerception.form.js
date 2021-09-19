import React, { Component } from 'react';
import {OnKeyPressService} from "../../../Core/Service/OnKeyPress.service.ts";
import {KeyEnum} from "../../../Core/Service/Enum/KeyEnum";
import {DriverNameFilter} from "../../../Core/Filter/DriverName.filter";
import axios from "axios";
import {StorageService} from "../../../Core/Service/Storage.service";

export default class SendingPerceptionForm extends Component {
    driverNameFilter$: DriverNameFilter = new DriverNameFilter();
    onKeyPressService$: OnKeyPressService = new OnKeyPressService();
    storageService$: StorageService = new StorageService();

    constructor(props) {
        super(props);

        this.state = {
            country: "",
            voivodeship: "",
            postal: "",
            city: "",
            street: "",
            number: "",
            capacity: "",
            weight: "",
            invalidCountry: true,
            invalidVoivodeship: true,
            invalidPostal: true,
            invalidCity: true,
            invalidStreet: true,
            invalidNumber: true,
            invalidCapacity: true,
            invalidWeight: true,
        };

        this.validateData = this.validateData.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleReceiptOrder = this.handleReceiptOrder.bind(this);
        this.handleSubmitKeyDown = this.handleSubmitKeyDown.bind(this);
    }

    handleSubmitKeyDown(event: KeyboardEvent): void {
        if (this.onKeyPressService$.isKeyPressed(event, KeyEnum.ENTER)) {
            this.handleReceiptOrder(event);
        }
    }

    handleReceiptOrder(event: KeyboardEvent) {
        const { country, voivodeship, postal, city, street, number, capacity, weight } = this.state;

        const { name } = this.props.data;
        let id = this.driverNameFilter$.getDriverId(name);

        axios
            .post(
                process.env.APP_DOMAIN + '/api/perception',
                {
                    perception: {
                        country: country,
                        voivodeship: voivodeship,
                        userId: id,
                        postal: postal,
                        city: city,
                        street: street,
                        number: number,
                        capacity: capacity,
                        weight: weight,
                    }
                },
                { withCredentials: true }
            )
            .then(response => {
                if (response.status === 200) {
                    this.storageService$.setSendingPerceptionId(Number.parseInt(response.data.id));
                    this.props.showNearByCallback(true);
                }
            })
            .catch(error => {
                console.log('TODO ERROR');
                this.props.showNearByCallback(false);
                //this.state.validateErrorMessage = "Taki kierowca nie istnieje";
            });
        event.preventDefault();
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
            case "country":
                if (value.length >= 3) {
                    this.setState({invalidCountry: false});
                } else {
                    this.setState({invalidCountry: true});
                }
                break;
            case "voivodeship":
                if (value.length >= 3) {
                    this.setState({invalidVoivodeship: false});
                } else {
                    this.setState({invalidVoivodeship: true});
                }
                break;
            case "postal":
                if (/^[0-9]{2}-[0-9]{3}$/.test(value)) {
                    this.setState({invalidPostal: false});
                } else {
                    this.setState({invalidPostal: true});
                }
                break;
            case "city":
                if (value.length > 1) {
                    this.setState({invalidCity: false});
                } else {
                    this.setState({invalidCity: true});
                }
                break;
            case "street":
                if (value.length >= 3) {
                    this.setState({invalidStreet: false});
                } else {
                    this.setState({invalidStreet: true});
                }
                break;
            case "number":
                if (value.length > 0) {
                    this.setState({invalidNumber: false});
                } else {
                    this.setState({invalidNumber: true});
                }
                break;
            case "capacity":
                value = parseInt(event.target.value);
                if (Number.isInteger(value)) {
                    if (value.valueOf() >= 0 && value.valueOf() <= 50) {
                        this.setState({invalidCapacity: false});
                    } else {
                        this.setState({invalidCapacity: true});
                    }
                } else {
                    this.setState({invalidCapacity: true});
                }
                break;
            case "weight":
                value = parseInt(event.target.value);
                if (Number.isInteger(value)) {
                    if (value.valueOf() >= 0 && value.valueOf() <= 1000) {
                        this.setState({invalidWeight: false});
                    } else {
                        this.setState({invalidWeight: true});
                    }
                } else {
                    this.setState({invalidWeight: true});
                }
                break;
        }
    }

    render() {
        return(
            <div className={"d-flex justify-content-center"}>
                <div className={"wysylanie-odbioru-form d-flex"}>
                    <form
                        onKeyDown={(e) => this.handleSubmitKeyDown(e)}
                        onSubmit={this.handleReceiptOrder}
                    >
                        <div className={"row margin-0 vertical-center " +
                        "modules-header-text-form wysylanie-odbioru-name " +
                        "wysylanie-odbioru-row"}>
                            <span>Zlecenie nowego odbioru</span>
                        </div>
                        <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                            <div className={"col text-center blue-outline-box"}>
                                <label><span>Kraj *</span></label>
                                <input
                                    type={"text"}
                                    name={"country"}
                                    value={this.state.country}
                                    placeholder={"np. Polska"}
                                    onChange={this.handleChange}
                                />
                                <label style={{display: this.state.invalidCountry ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                            </div>
                            <div className={"col text-center blue-outline-box"}>
                                <label><span>Województwo *</span></label>
                                <input
                                    type={"text"}
                                    name={"voivodeship"}
                                    value={this.state.voivodeship}
                                    placeholder={"np. Śląskie"}
                                    onChange={this.handleChange}
                                />
                                <label style={{display: this.state.invalidVoivodeship ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                            </div>
                        </div>
                        <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                            <div className={"col text-center blue-outline-box"}>
                                <label><span>Kod Pocztowy *</span></label>
                                <input
                                    type={"text"}
                                    name={"postal"}
                                    value={this.state.postal}
                                    placeholder={"np. 41-200"}
                                    onChange={this.handleChange}
                                />
                                <label style={{display: this.state.invalidPostal ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                            </div>
                            <div className={"col text-center blue-outline-box"}>
                                <label><span>Miasto *</span></label>
                                <input
                                    type={"text"}
                                    name={"city"}
                                    value={this.state.city}
                                    placeholder={"np. Sosnowiec"}
                                    onChange={this.handleChange}
                                />
                                <label style={{display: this.state.invalidCity ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                            </div>
                        </div>
                        <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                            <div className={"col text-center blue-outline-box"}>
                                <label><span>Ulica *</span></label>
                                <input
                                    type={"text"}
                                    name={"street"}
                                    value={this.state.street}
                                    placeholder={"np. Paderewskiego"}
                                    onChange={this.handleChange}
                                />
                                <label style={{display: this.state.invalidStreet ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                            </div>
                            <div className={"col text-center blue-outline-box"}>
                                <label><span>Numer *</span></label>
                                <input
                                    type={"text"}
                                    name={"number"}
                                    value={this.state.number}
                                    placeholder={"np. 38"}
                                    onChange={this.handleChange}
                                />
                                <label style={{display: this.state.invalidNumber ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                            </div>
                        </div>
                        <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                            <div className={"col text-center blue-outline-box"}>
                                <label><span>Powierzchnia *</span></label>
                                <input
                                    type={"text"}
                                    name={"capacity"}
                                    value={this.state.capacity}
                                    placeholder={"np. 1,2m²"}
                                    onChange={this.handleChange}
                                />
                                <label style={{display: this.state.invalidCapacity ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                            </div>
                            <div className={"col text-center blue-outline-box"}>
                                <label><span>Waga *</span></label>
                                <input
                                    type={"text"}
                                    name={"weight"}
                                    value={this.state.weight}
                                    placeholder={"np. 400kg"}
                                    onChange={this.handleChange}
                                />
                                <label style={{display: this.state.invalidWeight ? 'block' : 'none' }}>Wprowadzono niepoprawną wartość.</label>
                            </div>
                        </div>
                        <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                            <div className={"col text-center customize-button"}>
                                <button
                                    disabled={
                                        this.state.invalidCountry ||
                                        this.state.invalidVoivodeship ||
                                        this.state.invalidPostal ||
                                        this.state.invalidCity ||
                                        this.state.invalidStreet ||
                                        this.state.invalidNumber ||
                                        this.state.invalidCapacity ||
                                        this.state.invalidWeight
                                    }
                                    type={"button"}
                                    className={"btn btn-primary"}
                                    onClick={this.handleReceiptOrder}
                                ><span>Wyślij</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
}
