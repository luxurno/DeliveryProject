import React, {Component} from 'react';
import DriverSearchComponent from "../Components/DriverSearch/DriverSearchComponent";
import RouteLookupComponent from "../Components/RouteLookup/RouteLookupComponent";

class RouteLookup extends Component {
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
                <DriverSearchComponent data={this.state} callbackFromParent={this.driverNameCallback} />
                <RouteLookupComponent data={this.state}/>
            </div>
        );
    }
}

export default RouteLookup;
