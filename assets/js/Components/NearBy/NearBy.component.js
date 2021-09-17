import React, {Component} from 'react';
import {HeadersEnum} from "../../Core/Text/Enum/Headers.enum";
import {HeadersCustomBox} from "../../Core/Box/HeadersCustom.box";
import DriversNearByComponent from "../DriversNearBy/DriversNearBy.component";
import RouteLookupMap from "../../Core/Map/Google.map";

export default class NearByComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            list: [],
            perceptionLat: "",
            perceptionLng: "",
        };
    }

    driversNearByListCallback = (dataFromChild) => {
        this.setState({
            list: dataFromChild.list,
        })
    };

    nearByPerceptionCallback = (dataFromChild) => {
        this.setState({
            perceptionLat: dataFromChild?.lat,
            perceptionLng: dataFromChild?.lng,
        });
    };

    render() {
        let listaKierowcyStyles = {
            left: "50vh"
        };

        return(
            <div style={{display: this.props.data.showNearBy ? 'block' : 'none' }}>
                <HeadersCustomBox headersText={HeadersEnum.NEAR_BY} />
                <div className={"row margin-0 vertical-center"}>
                    <div className={"podglad-trasy-kierowcy-maps"} id={"map"}>
                        <RouteLookupMap data={this.state} />
                    </div>
                    <div className={"podglad-trasy-kierowcy-list"} style={listaKierowcyStyles}>
                        <DriversNearByComponent
                            data={this.state}
                            driversNearByListCallback={this.driversNearByListCallback}
                            nearByPerceptionCallback={this.nearByPerceptionCallback}
                        />
                    </div>
                </div>
            </div>
        );
    }
}
