import React, { Component } from 'react';
import axios from 'axios';
import DriverListComponent from "../DriverList/DriverListComponent";

class RouteGeneratorComponent extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        let { name, showConfig } = this.props.data;
        let displayStyle = {};

        if (showConfig === false) {
            displayStyle = {
                display: "none",
            };
        }

        let listaKierowcyStyles = {
            display: "flex !important",
            justifyContent: "center",
        };

        return(
            <div className={"generator-trasy-container"} style={displayStyle}>
                <div className={"d-flex justify-content-center"}>
                    <div className={"modules-header-text"}>
                        Wygenerowana Lista
                    </div>
                </div>
                <div className={"d-flex justify-content-center"}>
                    <DriverListComponent
                        data={this.props.data}
                        styles={listaKierowcyStyles}
                    />
                </div>
            </div>
        );
    }
}

export default RouteGeneratorComponent;
