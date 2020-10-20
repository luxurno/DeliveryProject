export class StorageService {
    currentUserId$ = 1;
    sendingPerceptionId$ = 1;

    getCurrentUserId(): number {
        return this.currentUserId$;
    }

    setCurrentUserId(currentUserId: number): void {
        this.currentUserId$ = currentUserId;
    }

    getSendingPerceptionId(): number {
        return this.sendingPerceptionId$;
    }

    setSendingPerceptionId(sendingPerceptionId: number): void {
        this.sendingPerceptionId$ = sendingPerceptionId;
    }
}
