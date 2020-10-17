import React, { Component } from 'react';
import ListaKierowcy from "../ListaKierowcy/ListaKierowcy";

class GeneratorTrasyModule extends Component {
    constructor() {
        super();

        this.state = {
            route: process.env.APP_DOMAIN + '/api/route/preview',
            name: "",
            showConfig: false
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleGenerateList = this.handleGenerateList.bind(this);
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
    }

    handleGenerateList() {
        console.log('handluje!');
    }

    render() {
        let { name, showConfig } = this.props.data;
        let displayStyle = {};

        if (showConfig === false) {
            displayStyle = {
                display: "none",
            };
        }
        if (name !== "") {
            this.handleGenerateList();
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
                    <ListaKierowcy data={this.state} styles={listaKierowcyStyles} />
                </div>
            </div>
        );
    }
}

export default GeneratorTrasyModule;
