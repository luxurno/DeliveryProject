import React, {Component} from 'react';
import WyszukiwanieKierowcyDatalist from "./WyszukiwanieKierowcyDatalist";

class WyszukanieKierowcy extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: "",
            showConfig: false,
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSearchDriver = this.handleSearchDriver.bind(this);
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
        this.props.callbackFromParent(this.state);
    }

    handleSearchDriver(event) {
        if (this.state.name === "") {
            this.setState({ showConfig: false});
        } else {
            this.setState({ showConfig: true});
        }
        this.props.callbackFromParent(this.state);
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
                                    <WyszukiwanieKierowcyDatalist/>
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

export default WyszukanieKierowcy;