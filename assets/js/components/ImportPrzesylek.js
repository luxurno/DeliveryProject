import React, {Component} from 'react';
import ImportPrzesylekModule from "./Modules/ImportPrzesylek/ImportPrzesylekModule";

class ImportPrzesylek extends Component {
    constructor() {
        super();

        this.state = {
            title: "Importuj dostawy",
            button: "Importuj",
            name: "",
            showConfig: false,
        };
    }

    driverNameCallback = (dataFromChild) => {
        this.setState({
            name: dataFromChild.name,
            showConfig: dataFromChild.showConfig,
        });
        // TODO Remove bug with missing one action (letter)
    };

    render() {
        return (
            <div>
                <ImportPrzesylekModule data={this.state} callbackFromParent={this.driverNameCallback}/>
            </div>
        );
    }
}
export default ImportPrzesylek;