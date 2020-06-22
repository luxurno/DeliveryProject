import React, {Component} from 'react';
import axios from 'axios';
import OddsElement from "./OddsElement/OddsElement";
import EvenElement from "./EvenElement/EvenElement";

class ListaKierowcy extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: "",
            list: [],
        };
    }

    componentDidMount() {
        axios.get(process.env.APP_DOMAIN + this.props.data.route).then(res => {
            const list = res.data;
            this.setState({ list: list });
        });
    }

    render() {
        let list = this.state.list;
        let html = [];

        for( let i=0; i < list.length; i++) {
            list[i]['id'] = i;
            if (i%2 === 0) {
                html.push(<OddsElement key={i} data={list[i]} />);
            } else {
                html.push(<EvenElement key={i} data={list[i]} />);
            }
        }

        return(
            <div className={"lista-kierowcy-container"}>
                {html}
            </div>
        );
    }

}

export default ListaKierowcy;