import React, {Component} from 'react';
import DriverSearch from "../Components/DriverSearch/DriverSearchComponent";
import SendingPerceptionComponent from "../Components/SendingPerception/SendingPerceptionComponent";
import {HeadersEnum} from "../Core/Text/Enum/Headers.enum";
import {ButtonEnum} from "../Core/Text/Enum/Button.enum";

export default class SendingPerception extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.DRIVER_SEARCH,
            button: ButtonEnum.SEARCH,
            name: "",
            showConfig: false,
        };
    }

    driverNameCallback = (dataFromChild) => {
        this.setState({
            name: dataFromChild.name,
            showConfig: dataFromChild.showConfig,
        });
    };

    render() {
        return(
            <div>
                <DriverSearch data={this.state} callbackFromParent={this.driverNameCallback} />
                <SendingPerceptionComponent data={this.state}/>
            </div>
        );
    }
}
