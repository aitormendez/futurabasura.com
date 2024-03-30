import { __ } from "@wordpress/i18n";

import edit from "./edit";
import save from "./save";

export const name = `clover/test`;

export const settings = {
  title: `Test`,
  edit,
  save,
  example: {
    attributes: {
      content: __("Test"),
    },
  },
};
