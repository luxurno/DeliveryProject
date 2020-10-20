import React, {Component} from 'react';
import SendingPerceptionComponent from "../Components/SendingPerception/SendingPerceptionComponent";

export default class SendingPerception extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: "",
            showConfig: false,
        };
    }

    render() {
        return(
            <div>
                <SendingPerceptionComponent data={this.state}/>
            </div>
        );
    }
}
