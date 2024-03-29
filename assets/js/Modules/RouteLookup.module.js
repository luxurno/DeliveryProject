import React, {Component} from 'react';
import DriverSearchComponent from "../Components/DriverSearch/DriverSearchComponent";
import RouteLookupComponent from "../Components/RouteLookup/RouteLookupComponent";
import { HeadersEnum } from "../Core/Text/Enum/Headers.enum";
import { ButtonEnum } from "../Core/Text/Enum/Button.enum";

class RouteLookup extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.DRIVER_SEARCH,
            button: ButtonEnum.SEARCH,
            available: '2',
            name: "",
            showConfig: false
        };
    }

    driverNameCallback = (dataFromChild) => {
        this.setState({
            name: dataFromChild.name,
            showConfig: dataFromChild.showConfig
        });
    };

    render() {
        return(
            <div>
                <DriverSearchComponent data={this.state} callbackFromParent={this.driverNameCallback} />
                <RouteLookupComponent data={this.state}/>
            </div>
        );
    }
}

export default RouteLookup;
