import React, {Component} from 'react';
import PodgladTrasyMap from "./PodgladTrasyMap";
import ListaKierowcy from "../ListaKierowcy/ListaKierowcy";

class PodgladTrasyKierowcy extends Component {
    constructor(props) {
        super(props);

        this.state = {
            route: '/api/route/preview',
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
        // TODO Remove bug with missing one action (letter)
    };

    render() {
        let { name, showConfig } = this.props.data;
        let displayStyle = {};

        if (showConfig === false) {
            displayStyle = {
                display: "none",
            };
        }
        let listaKierowcyStyles = {
            left: "55vh"
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
                        <PodgladTrasyMap data={this.state}/>
                    </div>
                    <div className={"podglad-trasy-kierowcy-list"} style={listaKierowcyStyles}>
                        <ListaKierowcy data={this.state} callbackFromParent={this.handleDriverListCallback}/>
                    </div>
                </div>
            </div>
        );
    }
}

export default PodgladTrasyKierowcy;