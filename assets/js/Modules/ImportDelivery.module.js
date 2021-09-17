import React, {Component} from 'react';
import ImportDeliveryComponent from "../Components/ImportDelivery/ImportDeliveryComponent";
import { HeadersEnum } from "../Core/Text/Enum/Headers.enum";
import { ButtonEnum } from "../Core/Text/Enum/Button.enum";

export default class ImportDelivery extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.IMPORT_DELIVERIES,
            button: ButtonEnum.IMPORT,
            name: "",
            showConfig: false,
        };
    }

    driverNameCallback = async (dataFromChild) => {
        await this.setState({
            name: dataFromChild.name,
            showConfig: dataFromChild.showConfig,
        });
    };

    render() {
        return (
            <div>
                <ImportDeliveryComponent data={this.state} callbackFromParent={this.driverNameCallback}/>
            </div>
        );
    }
}
