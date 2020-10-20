export class NameSlicer {
    getFirstName(name: String): String {
        let sliced = name.split(' ');
        return sliced[0];
    }

    getLastName(name: String): String {
        let sliced = name.split(' ');
        return sliced[1];
    }
}
