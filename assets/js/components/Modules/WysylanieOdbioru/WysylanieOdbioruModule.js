import React, {Component} from 'react';

class WysylanieOdbioruModule extends Component {
    constructor(props) {
        super(props);

        this.state = {
            postal: "",
            city: "",
            street: "",
            number: "",
            capacity: "",
            weight: "",
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleReceiptOrder = this.handleReceiptOrder.bind(this);
    }

    handleReceiptOrder() {
        console.log("here");
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
    }

    render() {
        return(
            <div className={"wysylanie-odbioru-container"}>
                <div className={"d-flex justify-content-center"}>
                    <div className={"modules-header-text"}>
                        Wysyłanie odbioru
                    </div>
                </div>
                <div className={"d-flex justify-content-center"}>
                    <div className={"wysylanie-odbioru-form d-flex"}>
                        <form onSubmit={this.handleReceiptOrder}>
                            <div className={"row margin-0 vertical-center " +
                            "modules-header-text-form wysylanie-odbioru-name " +
                            "wysylanie-odbioru-row"}>
                                Zlecenie nowego odbioru
                            </div>
                            <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Kod Pocztowy *</label>
                                    <input
                                        type={"text"}
                                        name={"postal"}
                                        value={this.state.postal}
                                        placeholder={"np. 41-200"}
                                        onChange={this.handleChange}
                                    />
                                </div>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Miasto *</label>
                                    <input
                                        type={"text"}
                                        name={"city"}
                                        value={this.state.city}
                                        placeholder={"np. Sosnowiec"}
                                        onChange={this.handleChange}
                                    />
                                </div>
                            </div>
                            <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Ulica *</label>
                                    <input
                                        type={"text"}
                                        name={"street"}
                                        value={this.state.street}
                                        placeholder={"np. Paderewskiego"}
                                        onChange={this.handleChange}
                                    />
                                </div>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Numer *</label>
                                    <input
                                        type={"text"}
                                        name={"number"}
                                        value={this.state.number}
                                        placeholder={"np. 38"}
                                        onChange={this.handleChange}
                                    />
                                </div>
                            </div>
                            <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Powierzchnia *</label>
                                    <input
                                        type={"text"}
                                        name={"capacity"}
                                        value={this.state.capacity}
                                        placeholder={"np. 1,2m2"}
                                        onChange={this.handleChange}
                                    />
                                </div>
                                <div className={"col text-center blue-outline-box"}>
                                    <label>Waga *</label>
                                    <input
                                        type={"text"}
                                        name={"weight"}
                                        value={this.state.weight}
                                        placeholder={"np. 400kg"}
                                        onChange={this.handleChange}
                                    />
                                </div>
                            </div>
                            <div className={"row margin-0 vertical-center wysylanie-odbioru-row"}>
                                <div className={"col text-center customize-button"}>
                                    <button
                                        type={"button"}
                                        className={"btn btn-primary"}
                                        onClick={this.handleReceiptOrder}
                                    >Wyślij</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}

export default WysylanieOdbioruModule;