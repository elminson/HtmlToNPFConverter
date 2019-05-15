# Coding Exercise: HTML to NPF Conversion

This coding exercise is about converting HTML into PHP objects that can be JSON-serialized, which is a simplied version of a real-world Tumnblr feature called [the Neue Post Format](https://engineering.tumblr.com/post/164826109535/building-the-tumblr-neue-post-format).

The most simple example of this is already included in the code provided here, which turns paragraph `<p>` tags into "text" blocks:

```html
<p>hello!</p>
```

Becomes:

```json
{
    "type": "text",
    "text": "hello!"
}
```

The main goal of this exercise is to go through the problems listed below and make the unit tests pass.

Your job is to expand, rewrite, refactor the code that does the HTML-to-NPF conversion.

## Running the Unit Tests

This exercise comes with `phpunit` to run the unit tests via command line:

```
$ ./phpunit.phar HtmlToNPFConverterTest.php
```

We've tried to include helpful messages in the unit test failures.

## Problems to Solve

The initial implementation has a very simple level of abstraction (`ContentBlock`) and needs to grow pretty quickly, but also needs to stay safe with unit testing.

### Dealing with Images

We want to convert `<img>` tags into new ImageContentBlocks! We've stubbed out the start of a unit test for it with example HTML in `data/post_content_complex.html`, but we need the actual class and parsing. Use TextContentBlock as an example.

### A Container for Content Blocks

The `HtmlToNPFConverter::convert()` method returns an array, but it'd be nicer to return some kind of container of ContentBlocks. How would you do that?

It'd be even cooler if you could call `json_encode()` on that container and it JSON-encodes all of the ContentBlocks it holds.

### Product Decision: Don't Preserve Empty Paragraphs!

We don't want to preserve empty `<p>` tags as text content blocks; we'd rather skip them in the NPF format. Refactor the code and unit tests to match.

### Inline Text Formatting

We want to detect the inline formatting tags (like `<b>` and `<i>`) inside `<p>` tags and turn them into some kind of FormattingObject within the TextContentBlock.

The formatting range object should have a type (for example, "bold") and a range for what part of the text content block should be formatted.

We've stubbed out the start of a unit test for it with an example in `data/post_content_formatting.html`.

### More Inline Text Formatting

We also want to be able to convert `<p>` tags with special class names, like `quirky`, into a new sub-type of TextContentBlock. How would you do that?
