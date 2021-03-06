module.exports = {
  'extends': 'stylelint-config-standard',
  'ignoreFiles': ["**/*.js"],
  'rules': {
    'indentation': null,
    'no-empty-source': null,
    'string-quotes': 'double',
    'declaration-colon-newline-after': null,
    'no-descending-specificity': null,
    'selector-descendant-combinator-no-non-space': null,
    'comment-whitespace-inside': null,
    'selector-combinator-space-before': null,
    'value-list-comma-newline-after': null,
    'font-family-no-missing-generic-family-keyword': null,
    'media-feature-name-no-unknown': null,
    'block-closing-brace-newline-after': 'never-single-line',
    'at-rule-empty-line-before': [
      null,
      {
        'except': ["inside-block"]
      }
    ],
    'at-rule-no-unknown': [
      true,
      {
        'ignoreAtRules': [
          'extend',
          'at-root',
          'debug',
          'warn',
          'error',
          'if',
          'else',
          'for',
          'each',
          'while',
          'mixin',
          'include',
          'content',
          'return',
          'function',
          'tailwind',
          'apply',
          'responsive',
          'variants',
          'screen',
        ],
      },
    ],
  },
};
