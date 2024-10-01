import { Integration } from '@sentry/types';
/** JSDoc */
interface BreadcrumbsOptions {
    console: boolean;
    dom: boolean | {
        serializeAttribute?: string | string[];
        maxStringLength?: number;
    };
    fetch: boolean;
    history: boolean;
    sentry: boolean;
    xhr: boolean;
}
/**
 * Default Breadcrumbs instrumentations
 * TODO: Deprecated - with v6, this will be renamed to `Instrument`
 */
export declare class Breadcrumbs implements Integration {
    /**
     * @inheritDoc
     */
    static id: string;
    /**
     * @inheritDoc
     */
    name: string;
    /**
     * Options of the breadcrumbs integration.
     */
    readonly options: Readonly<BreadcrumbsOptions>;
    /**
     * @inheritDoc
     */
    constructor(options?: Partial<BreadcrumbsOptions>);
    /**
     * Instrument browser built-ins w/ breadcrumb capturing
     *  - Console API
     *  - DOM API (click/typing)
     *  - XMLHttpRequest API
     *  - Fetch API
     *  - History API
     */
    setupOnce(): void;
}
export {};
//# sourceMappingURL=breadcrumbs.d.ts.map
