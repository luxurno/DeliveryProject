import React, {Component} from 'react';
import RouteLookupMap from "../../Core/Map/Google.map";
import DriverListLookupComponent from "../DriverListLookup/DriverListLookupComponent";
import {DriverNameFilter} from "../../Core/Filter/DriverName.filter";

class RouteLookupComponent extends Component {
    driverNameFilter$: DriverNameFilter = new DriverNameFilter();

    constructor(props) {
        super(props);

        this.state = {
            list: [],
        };

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
    }

    handleDriverListCallback = (dataFromChild) => {
        this.setState({
            list: dataFromChild.list,
        });
    };

    render() {
        let { name, showConfig } = this.props.data;
        let displayStyle = {};

        name = this.driverNameFilter$.getDriverName(name);
        if (showConfig === false) {
            displayStyle = {
                display: "none",
            };
        }
        let listaKierowcyStyles = {
            left: "50vh"
        };

        return(
            <div className={"podglad-trasy-kierowcy-container"} style={displayStyle}>
                <div className={"d-flex justify-content-center"}>
                    <div className={"modules-header-text"}>
                        Podgląd trasy: {name}
                    </div>
                </div>
                <div className={"row margin-0 vertical-center"}>
                    <div className={"podglad-trasy-kierowcy-maps"} id={"map"}>
                        <RouteLookupMap data={this.state}/>
                    </div>
                    <div className={"podglad-trasy-kierowcy-list"} style={listaKierowcyStyles}>
                        <DriverListLookupComponent data={this.props.data} callbackFromParent={this.handleDriverListCallback}/>
                    </div>
                </div>
            </div>
        );
    }
}

export default RouteLookupComponent;
