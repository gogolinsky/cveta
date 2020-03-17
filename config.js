require("dotenv").config();

const locals = require("./data/storage");
const env = process.env.NODE_ENV;
const root = process.env.SRC || "src";
const dest = process.env.DEST || "web";
const build = process.env.BUILD || "web";
const isProduction = env === "production";

module.exports = {
  env,
  isProduction,
  locals,
  path: {
    root,
    dest,
    build
  }
};
