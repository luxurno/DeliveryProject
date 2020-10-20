export class OnKeyPressService {
    isKeyPressed(event: KeyboardEvent, key: String): boolean {
        return event.key === key;
    }
}
