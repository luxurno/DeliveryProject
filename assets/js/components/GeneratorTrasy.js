import React, {Component} from 'react';
import WyszukanieKierowcy from "./Modules/WyszukanieKierowcy/WyszukanieKierowcy";
import KonfiguracjaKierowcy from "./Modules/KonfiguracjaKierowcy/KonfiguracjaKierowcy";
import GeneratorTrasyModule from "./Modules/GeneratorTrasy/GeneratorTrasyModule";

class GeneratorTrasy extends Component {
    constructor() {
        super();

        this.state = {
            title: "Generator Trasy",
            button: "Generuj",
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
        return(
            <div>
                <WyszukanieKierowcy data={this.state} callbackFromParent={this.driverNameCallback} />
                <GeneratorTrasyModule data={this.state} />
            </div>
        );
    }
}

export default GeneratorTrasy;