import React, {Component} from 'react';
import WyszukanieKierowcy from "./Modules/WyszukanieKierowcy/WyszukanieKierowcy";
import PodgladTrasyKierowcy from "./Modules/PodgladTrasyKierowcy/PodgladTrasyKierowcy";

class PodgladTrasy extends Component {
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
            showConfig: dataFromChild.showConfig
        });
        // TODO Remove bug with missing one action (letter)
    };

    render() {
        let podgladTrasyKierowcyStyle = {
            left: '55vh',
        };

        return(
            <div>
                <WyszukanieKierowcy data={this.state} callbackFromParent={this.driverNameCallback} />
                <PodgladTrasyKierowcy data={this.state}/>
            </div>
        );
    }
}

export default PodgladTrasy;