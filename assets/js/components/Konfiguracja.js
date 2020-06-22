import React, {Component} from 'react';
import {Route, Switch} from 'react-router-dom';
import WyszukanieKierowcy from "./Modules/WyszukanieKierowcy/WyszukanieKierowcy";
import KonfiguracjaKierowcy from "./Modules/KonfiguracjaKierowcy/KonfiguracjaKierowcy";

class Konfiguracja extends Component {
    constructor() {
        super();

        this.state = {
            title: "Wyszukiwanie Kierowcy",
            button: "Wyszukaj",
            name: "",
            showConfig: false
        };
    }

    driverNameCallback = (dataFromChild) => {
        this.setState({
            name: dataFromChild.name,
            showConfig: dataFromChild.showConfig,
        });
        // TODO Remove bug with missing one action (letter)
    };

    render() {
        return (
            <div>
                <WyszukanieKierowcy data={this.state} callbackFromParent={this.driverNameCallback} />
                <KonfiguracjaKierowcy data={this.state}/>
            </div>
        );
    }
}
export default Konfiguracja;