import React, {Component} from 'react';

export class AddressOddsBlock extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        let houseNumber = "";
        if (this.props.data.house) {
            houseNumber = "/" + this.props.data.house;
        }

        return (
            <div className={"list-odds-element"}>
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
                    </div>
                </div>
            </div>
        );
    }
}
