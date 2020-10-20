import React, {Component} from 'react';
import { Map, GoogleApiWrapper, Marker } from 'google-maps-react';
import {GoogleIconEnum} from "../Icon/GoogleIcon.enum";

const mapStyles = {
    marginLeft: '25vh',
    width: '120vh',
    height: '100vh'
};

const icon = {
    url: GoogleIconEnum.BLUE_ICON,
};

class GoogleMap extends Component {
    constructor(props) {
        super(props);

        this.state = {
            list: this.props.data.list,
        };

        this.handleMapMarkers = this.handleMapMarkers.bind(this);
    }

    handleMapMarkers = () => {
        let markers = [];

        markers.push(<Marker key={0} id={0} position={{
            lat: this.props.data.perceptionLat,
            lng: this.props.data.perceptionLng,
        }} options={{icon}}
        />);

        return markers.concat(
            this.props.data.list.map((element, index) => {
                if (element?.area) {
                    let elementCount = element.area.length;
                    return element.area.map((element, areaIndex) => {
                        let calculatedIndex = index * elementCount + areaIndex + 1;
                        return <Marker key={calculatedIndex} id={calculatedIndex} position={{
                            lat: element.lat,
                            lng: element.lng
                        }} />
                    });
                } else {
                    index += 1;
                    return <Marker key={index} id={index} position={{
                        lat: element.lat,
                        lng: element.lng
                    }} />
                }
            })
        )
    };

    render() {
        return (
            <Map
                google={this.props.google}
                zoom={10}
                style={mapStyles}
                initialCenter={{
                    lat: 50.2539773,
                    lng: 19.1911544
                }}
            >
                {this.handleMapMarkers()}
            </Map>
        );
    }
}

export default GoogleApiWrapper({
    apiKey: 'AIzaSyAmoNCrb5Zy4EIIGfkVWWXHr9Ev_xKy7Oc'
})(GoogleMap);
