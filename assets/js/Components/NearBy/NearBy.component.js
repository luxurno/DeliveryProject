import React, {Component} from 'react';
import {HeadersEnum} from "../../Core/Text/Enum/Headers.enum";
import {HeadersCustomBox} from "../../Core/Box/HeadersCustom.box";
import DriversNearByComponent from "../DriversNearBy/DriversNearBy.component";
import RouteLookupMap from "../RouteLookup/Map/RouteLookupMap";

export default class NearByComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            list: [],
        };
    }

    driversNearByListCallback = (dataFromChild) => {
        this.setState({
            list: dataFromChild.list,
        })
        // TODO Remove bug with missing one action (letter)
    };

    render() {
        let listaKierowcyStyles = {
            left: "55vh"
        };

        return(
            <div style={{display: this.props.data.showNearBy ? 'block' : 'none' }}>
                <HeadersCustomBox headersText={HeadersEnum.NEAR_BY} />
                <div className={"row margin-0 vertical-center"}>
                    <div className={"podglad-trasy-kierowcy-maps"} id={"map"}>
                        <RouteLookupMap data={this.state} />
                    </div>
                    <div className={"podglad-trasy-kierowcy-list"} style={listaKierowcyStyles}>
                        <DriversNearByComponent data={this.state} driversNearByListCallback={this.driversNearByListCallback}/>
                    </div>
                </div>
            </div>
        );
    }
}
