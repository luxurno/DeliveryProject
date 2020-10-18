import React, {Component} from 'react';
import DriverSearch from "../Components/DriverSearch/DriverSearchComponent";
import DriverConfig from "../Components/DriverConfig/DriverConfig";
import { HeadersEnum } from "../Text/Enum/HeadersEnum";
import { ButtonEnum } from "../Text/Enum/ButtonEnum";

class Settings extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.DRIVER_SEARCH,
            button: ButtonEnum.SEARCH,
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
                <DriverSearch data={this.state} callbackFromParent={this.driverNameCallback} />
                <DriverConfig data={this.state}/>
            </div>
        );
    }
}
export default Settings;
