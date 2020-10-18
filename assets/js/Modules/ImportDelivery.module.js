import React, {Component} from 'react';
import ImportDeliveryComponent from "../Components/ImportDelivery/ImportDeliveryComponent";

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
                <ImportDeliveryComponent data={this.state} callbackFromParent={this.driverNameCallback}/>
            </div>
        );
    }
}
