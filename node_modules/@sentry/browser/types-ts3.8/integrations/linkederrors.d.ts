import { Client, Event, EventHint, Integration } from '@sentry/types';
interface LinkedErrorsOptions {
    key: string;
    limit: number;
}
/** Adds SDK info to an event. */
export declare class LinkedErrors implements Integration {
    /**
     * @inheritDoc
     */
    static id: string;
    /**
     * @inheritDoc
     */
    readonly name: string;
    /**
     * @inheritDoc
     */
    private readonly _key;
    /**
     * @inheritDoc
     */
    private readonly _limit;
    /**
     * @inheritDoc
     */
    constructor(options?: Partial<LinkedErrorsOptions>);
    /** @inheritdoc */
    setupOnce(): void;
    /**
     * @inheritDoc
     */
    preprocessEvent(event: Event, hint: EventHint | undefined, client: Client): void;
}
export {};
//# sourceMappingURL=linkederrors.d.ts.map
