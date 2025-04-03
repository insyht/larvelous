import type { Hub } from '@sentry/core';
import { Integrations as CoreIntegrations } from '@sentry/core';
import type { UserFeedback } from '@sentry/types';
import type { BrowserOptions } from './client';
import type { ReportDialogOptions } from './helpers';
import { Breadcrumbs, Dedupe, GlobalHandlers, HttpContext, LinkedErrors, TryCatch } from './integrations';
export declare const defaultIntegrations: (GlobalHandlers | TryCatch | Breadcrumbs | LinkedErrors | HttpContext | Dedupe | CoreIntegrations.InboundFilters | CoreIntegrations.FunctionToString)[];
/**
 * The Sentry Browser SDK Client.
 *
 * To use this SDK, call the {@link init} function as early as possible when
 * loading the web page. To set context information or send manual events, use
 * the provided methods.
 *
 * @example
 *
 * ```
 *
 * import { init } from '@sentry/browser';
 *
 * init({
 *   dsn: '__DSN__',
 *   // ...
 * });
 * ```
 *
 * @example
 * ```
 *
 * import { configureScope } from '@sentry/browser';
 * configureScope((scope: Scope) => {
 *   scope.setExtra({ battery: 0.7 });
 *   scope.setTag({ user_mode: 'admin' });
 *   scope.setUser({ id: '4711' });
 * });
 * ```
 *
 * @example
 * ```
 *
 * import { addBreadcrumb } from '@sentry/browser';
 * addBreadcrumb({
 *   message: 'My Breadcrumb',
 *   // ...
 * });
 * ```
 *
 * @example
 *
 * ```
 *
 * import * as Sentry from '@sentry/browser';
 * Sentry.captureMessage('Hello, world!');
 * Sentry.captureException(new Error('Good bye'));
 * Sentry.captureEvent({
 *   message: 'Manual',
 *   stacktrace: [
 *     // ...
 *   ],
 * });
 * ```
 *
 * @see {@link BrowserOptions} for documentation on configuration options.
 */
export declare function init(options?: BrowserOptions): void;
/**
 * Present the user with a report dialog.
 *
 * @param options Everything is optional, we try to fetch all info need from the global scope.
 */
export declare function showReportDialog(options?: ReportDialogOptions, hub?: Hub): void;
/**
 * This function is here to be API compatible with the loader.
 * @hidden
 */
export declare function forceLoad(): void;
/**
 * This function is here to be API compatible with the loader.
 * @hidden
 */
export declare function onLoad(callback: () => void): void;
/**
 * Wrap code within a try/catch block so the SDK is able to capture errors.
 *
 * @deprecated This function will be removed in v8.
 * It is not part of Sentry's official API and it's easily replaceable by using a try/catch block
 * and calling Sentry.captureException.
 *
 * @param fn A function to wrap.
 *
 * @returns The result of wrapped function call.
 */
export declare function wrap(fn: (...args: any) => any): any;
/**
 * Captures user feedback and sends it to Sentry.
 */
export declare function captureUserFeedback(feedback: UserFeedback): void;
//# sourceMappingURL=sdk.d.ts.map