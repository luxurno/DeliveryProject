import React, {Component} from 'react';
import { Map, GoogleApiWrapper } from 'google-maps-react';

const mapStyles = {
    marginLeft: '30vh',
    width: '120vh',
    height: '100vh'
};

class PodgladTrasyMap extends Component {
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
            />
        );
    }
}

export default GoogleApiWrapper({
    apiKey: 'AIzaSyAmoNCrb5Zy4EIIGfkVWWXHr9Ev_xKy7Oc'
})(PodgladTrasyMap);