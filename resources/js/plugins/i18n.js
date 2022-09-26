import { createI18n } from "vue-i18n";
import messages from "../locale";

export const i18n = createI18n({
    locale: "mm",
    fallbackLocale: "mm",
    messages,
});

/**
 * It takes a message as a parameter, and returns the translation of that message
 * @param message - The message to be translated.
 * @returns The translation of the message.
 */
export const t = (message) => { 
    return i18n.global.t(`message.${message}`);
};

export default {
    i18n,
    t,
}