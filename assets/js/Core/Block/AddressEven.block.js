import React, {Component} from 'react';

export class AddressEvenBlock extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        let perception = null;
        let houseNumber = "";
        if (this.props.data.house) {
            houseNumber = "/" + this.props.data.house;
        }
        if ('1' === this.props.data.is_perception) {
            perception = <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/000000/external-pointer-map-location-flatart-icons-outline-flatarticons.png"/>
        }

        return(
            <div className={"list-even-element"}>
                <div className={"row margin-0"}>
                    <div className={"list-element-number"}>
                        {this.props.data.id + 1}.
                    </div>
                    <div className={"list-element-address-box"}>
                        <div className={"list-element-address-one"}>
                            {this.props.data.postal} {this.props.data.city}
                        </div>
                        <div className={"list-element-address-two"}>
                            {this.props.data.street} {this.props.data.number}{houseNumber}
                        </div>
                        <div className={"list-element-address-three"}>
                            {perception}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
