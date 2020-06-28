import React, {Component} from 'react';
import { Map, GoogleApiWrapper, Marker } from 'google-maps-react';

const mapStyles = {
    marginLeft: '30vh',
    width: '120vh',
    height: '100vh'
};

class PodgladTrasyMap extends Component {
    constructor(props) {
        super(props);

        this.state = {
            list: this.props.data.list,
        };

        this.handleMapMarkers = this.handleMapMarkers.bind(this);
    }

    handleMapMarkers = () => {
        return this.props.data.list.map((element, index) => {
            return <Marker key={index} id={index} position={{
                lat: element.lat,
                lng: element.long
            }} />
        })
    };

    render() {

        console.log(this.props.data.list);
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
})(PodgladTrasyMap);