function transformPhp(source) {
  const content = source.data || '';

  const cleanedContent = content.replace(/<\?(?:php|=)?[\s\S]*?(?:\?>|$)/gi, (match) => {
    return match.replace(/[^\r\n]/g, ' ');
  });

  return [{
    data: cleanedContent,
    filename: source.filename,
    line: 1,
    column: 1,
    offset: 0
  }];
}

transformPhp.api = 1;

export default transformPhp;
