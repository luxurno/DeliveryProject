import React, {Component} from 'react';
import axios from 'axios';

class KonfiguracjaKierowcy extends Component {
    constructor(props) {
        super(props);

        this.state = {
            height: "",
            width: "",
            capacity: "",
            adr: "",
        };

        this.handleChange = this.handleChange.bind(this);
        this.getDriverId = this.getDriverId.bind(this);
        this.handleSaveConfiguration = this.handleSaveConfiguration.bind(this);
    }

    handleChange(event) {
        console.log(event.target.name);
        this.setState({
            [event.target.name]: event.target.value
        });
    }

    getDriverId(name) {
        let id = name.split(".");
        return id[0];
    }

    handleSaveConfiguration(event) {
        const { height, width, capacity, adr } = this.state;

        const { name } = this.props.data;
        let id = this.getDriverId(name);

        axios
            .post(
                process.env.APP_DOMAIN + "/api/driver/save",
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
                    window.location = '/konfiguracja'
                }
            })
            .catch(error => {
                this.state.validateErrorMessage = "Taki sklep już istnieje!";
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
                        Konfiguracja Kierowcy
                    </div>
                </div>
                <div className={"d-flex justify-content-center"}>
                    <div className={"konfiguracja-kierowcy-form d-flex"}>
                        <form onSubmit={this.handleSaveConfiguration}>
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
                                    <label>Wprowadzono niepoprawną wartość.</label>
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
                                    <label>Wprowadzono niepoprawną wartość.</label>
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
                                    <label>Wprowadzono niepoprawną wartość.</label>
                                </div>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Uprawnienia ADR *</label>
                                    <input
                                        type={"text"}
                                        name={"adr"}
                                        value={this.state.adr}
                                        placeholder={"np. TAK"}
                                        onChange={this.handleChange}
                                    />
                                    <label>Wprowadzono niepoprawną wartość.</label>
                                </div>
                            </div>
                            <div className={"row margin-0 vertical-center konfiguracja-kierowcy-row"}>
                                <div className={"col text-center customize-button"}>
                                    <button
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

export default KonfiguracjaKierowcy;