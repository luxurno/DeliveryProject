import React, { Component } from 'react';
import DriverSearch from "../Components/DriverSearch/DriverSearchComponent";
import DriverConfig from "../Components/DriverConfig/DriverConfig";
import RouteGeneratorComponent from "../Components/RouteGenerator/RouteGeneratorComponent";

export default class RouteGenerator extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.ROUTE_GENERATOR,
            button: ButtonEnum.GENERATE,
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
                <DriverSearch data={this.state} callbackFromParent={this.driverNameCallback} />
                <RouteGeneratorComponent data={this.state} />
            </div>
        );
    }
}