import React, {Component} from 'react';
import {HeadersEnum} from "../Core/Text/Enum/Headers.enum";
import {ButtonEnum} from "../Core/Text/Enum/Button.enum";
import DriverAdd from "../Components/DriverAdd/DriverAddComponent";

export default class AddDriverModule extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.DRIVER_ADD,
            button: ButtonEnum.ADD,
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
                <DriverAdd data={this.state} callbackFromParent={this.driverNameCallback} />
            </div>
        );
    }
}
