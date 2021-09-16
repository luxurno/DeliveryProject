import React, {Component} from 'react';
import {HeadersEnum} from "../Core/Text/Enum/Headers.enum";
import {ButtonEnum} from "../Core/Text/Enum/Button.enum";
import DriverRemove from "../Components/DriverRemove/DriverRemoveComponent";

export default class RemoveDriverModule extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.DRIVER_REMOVE,
            button: ButtonEnum.REMOVE,
            name: "",
        };
    }

    driverNameCallback = (dataFromChild) => {
        this.setState({
            name: dataFromChild.name,
        });
    };

    render() {
        return (
            <div>
                <DriverRemove data={this.state} callbackFromParent={this.driverNameCallback} />
            </div>
        );
    }
}
