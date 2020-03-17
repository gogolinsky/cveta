const fs = require('fs');
const config = require('./gulp/config');

const components = getComponents();
const mkdirp = require('mkdirp');

const componentName = process.argv[2];
const defaultExtensions = ['scss', 'pug'];
const extensions = uniqueArray(defaultExtensions.concat(process.argv.slice(3)));

function generateComponentsImport() {
  const components = fs
    .readdirSync(`${config.src.components}`)
    .filter(component => component !== 'components.json');

  const pugComponentsImportList = components.map(
    component =>
      `include /components/${component}/${component}\n`
  );

  const scssComponentsImportList = components.map(
    component =>
      `@import '../components/${component}/${component}';\n`
  );

  fs.writeFileSync(
    `${config.src.pages}/include/components.pug`,
    pugComponentsImportList.join('')
  );

  fs.writeFileSync(
    `${config.src.styles}/_components.scss`,
    scssComponentsImportList.join('')
  );
}

function getComponents() {
  const files = fs.readdirSync(`${config.src.components}`);
  files.splice(files.indexOf('components.json'), 1);

  return files;
}

function uniqueArray(arr) {
  const objectTemp = {};
  for (let i = 0; i < arr.length; i++) {
    const str = arr[i];
    objectTemp[str] = true;
  }

  return Object.keys(objectTemp);
}

function fileExist(path) {
  try {
    fs.statSync(path);
  } catch (err) {
    return !(err && err.code === 'ENOENT');
  }
}

function componentExist(componentName) {
  let hasThisComponent = false;
  for (const component in components) {
    if (components[component] === componentName) hasThisComponent = true;
  }

  if (!hasThisComponent) {
    components.push(componentName);
    const newPackageJson = JSON.stringify(components, '', 2);
    fs.writeFileSync(
      `${config.src.components}/components.json`,
      newPackageJson
    );

    console.log('Components added to components.json');
  }

  return hasThisComponent;
}

function createDir(dirPath) {
  const hasThisComponent = componentExist(componentName);
  mkdirp(dirPath, err => {
    if (err) return console.error(`Error: ${err}`);
    hasThisComponent
      ? console.log(`Notice: component "${componentName}" is already exist`)
      : console.log(`Notice: component "${componentName}" created`);
    extensions.forEach(extension => {
      extentionHandler(extension, dirPath, componentName);
    });
  });
}

function extentionHandler(extention, dirPath, componentName) {
  const filePath = `${dirPath + componentName}.${extention}`;
  let fileContent = '';
  const fileCreateMsg = '';

  // prettier-ignore
  switch (extention) {
  case 'scss':
    fileContent = `/**\n* ${componentName}\n*/\n\n.${componentName} {\n  $${componentName}: &;\n}\n`;
    break;
  case 'pug':
    fileContent = `//- ${componentName}\n\nmixin ${componentName}(options = {})\n  .${componentName}`;
    break;
  case 'js':
    fileContent = `/**\n* ${componentName}\n*/\n`;
    break;
  case 'img':
    const imgFolder = `${dirPath}img/`;
    if (fileExist(imgFolder) === true) {
      console.log(`Error: folder "${imgFolder}" is already exist`);
      break;
    }
    mkdirp(imgFolder, err => {
      if (err) return console.error(err);

      console.log(`Folder added: "${imgFolder}"`);
    });
    break;
  default:
    break;
  }

  createFiles(filePath, extention, fileContent, fileCreateMsg);
}

function createFiles(filePath, extention, fileContent, fileCreateMsg) {
  if (fileExist(filePath) === false && extention !== 'img') {
    fs.writeFile(filePath, fileContent, err => {
      if (err) return console.log(`Error: ${err}`);
      if (fileCreateMsg) console.warn(fileCreateMsg);

      generateComponentsImport();

      console.log(`Notice: file "${filePath}" added`);
    });
  } else if (extention !== 'img') {
    console.log(`Error: file "${filePath}" is already exist`);
  }
}

if (!componentName) {
  console.log('Error: enter component name');
} else {
  createDir(`${config.src.components}/${componentName}/`);
}
