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
        await axios.get(process.env.APP_DOMAIN + '/api/perception?id=' + this.props.perceptionId).then(res => {
            const perception = res.data;
            this.setState({ perception: perception });
        });
    }

    componentDidMount() {
        this.getPerceptionData().then(r => {
            this.props.callbackPerception(this.state);
        });
    }

    render() {
        return(
            <div className={"list-near-by-perception-block"}>
                <div className={"wrapper"}>
                    <div className={"item-all item-a"}><label>Przypisz odbiór&nbsp;</label><img src={GoogleIconEnum.BLUE_ICON} /></div>
                    <div className={"item-all item-b"}><label>Kod pocztowy:&nbsp;</label><span>{this.state.perception?.postal}</span></div>
                    <div className={"item-all item-c"}><label>Miasto:&nbsp;</label><span>{this.state.perception?.city}</span></div>
                    <div className={"item-all item-d"}><label>Ulica:&nbsp;</label><span>{this.state.perception?.street}</span></div>
                    <div className={"item-all item-e"}><label>Numer:&nbsp;</label><span>{this.state.perception?.number}</span></div>
                    <div className={"item-all item-f"}><label>Powierzchnia:&nbsp;</label><span>{this.state.perception?.capacity}m²</span></div>
                    <div className={"item-all item-g"}><label>Waga:&nbsp;</label><span>{this.state.perception?.weight}kg</span></div>
                </div>
            </div>
        );
    }
}