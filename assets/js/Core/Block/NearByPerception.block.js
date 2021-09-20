import React, {Component} from 'react';
import axios from 'axios';
import {GoogleIconEnum} from "../Icon/GoogleIcon.enum";

export default class NearByPerceptionBlock extends Component {
    constructor(props) {
        super(props);

        this.state = {
            perception: null,
        };
    }

    async getPerceptionData() {
        await axios.get(process.env.APP_DOMAIN + '/api/perception/' + this.props.perceptionId).then(res => {
            const perception = res.data;
            this.setState({ perception: perception });
        });
    }

    componentDidUpdate(prevProps: Readonly<P>, prevState: Readonly<S>, snapshot: SS) {
        if (prevProps.perceptionId !== this.props.perceptionId) {
            this.getPerceptionData().then(r => {
                this.props.callbackPerception(this.state);
            });
        }
    }

    render() {
        return(
            <div className={"list-near-by-perception-block"}>
                <div className={"wrapper"}>
                    <div className={"item-all item-a"}><label>Przypisz odbiór&nbsp;</label><img src={GoogleIconEnum.BLUE_ICON} /></div>
                    <div className={"item-all item-b"}><label>Kraj:&nbsp;</label><span>{this.state.perception?.country}</span></div>
                    <div className={"item-all item-c"}><label>Wojewódźstwo:&nbsp;</label><span>{this.state.perception?.voivodeship}</span></div>
                    <div className={"item-all item-d"}><label>Kod pocztowy:&nbsp;</label><span>{this.state.perception?.postal}</span></div>
                    <div className={"item-all item-e"}><label>Miasto:&nbsp;</label><span>{this.state.perception?.city}</span></div>
                    <div className={"item-all item-f"}><label>Ulica:&nbsp;</label><span>{this.state.perception?.street}</span></div>
                    <div className={"item-all item-g"}><label>Numer:&nbsp;</label><span>{this.state.perception?.number}</span></div>
                    <div className={"item-all item-h"}><label>Powierzchnia:&nbsp;</label><span>{this.state.perception?.capacity}m²</span></div>
                    <div className={"item-all item-i"}><label>Waga:&nbsp;</label><span>{this.state.perception?.weight}kg</span></div>
                </div>
            </div>
        );
    }
}
