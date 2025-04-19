[Human readable duration format](https://www.codewars.com/kata/human-readable-duration-format)

# Human-Readable Duration Format

## Description

Your task in order to complete this Kata is to write a function which formats a duration, given as a number of seconds, in a human-friendly way.

The function must accept a non-negative integer. If it is zero, it just returns `"now"`. Otherwise, the duration is expressed as a combination of **years**, **days**, **hours**, **minutes**, and **seconds**.

> For the purpose of this Kata, a year is 365 days and a day is 24 hours.

It is much easier to understand with examples:

- For `seconds = 62`, your function should return:
  ```
  "1 minute and 2 seconds"
  ```

- For `seconds = 3662`, your function should return:
  ```
  "1 hour, 1 minute and 2 seconds"
  ```

## Detailed Rules

- The resulting expression is made of components like `4 seconds`, `1 year`, etc.
- Each component is a **positive integer** and one of the valid **units of time**, separated by a **space**.
- The **unit of time is plural** if the value is greater than 1 (e.g., `2 minutes`).
- Components are separated by a comma and a space (`, `), **except the last**, which is separated by `" and "`.
- **More significant units come before** less significant ones. Example: `"1 year and 1 second"`, not `"1 second and 1 year"`.
- **No repeated units**. For example: `"5 seconds and 1 second"` is invalid.
- Components with a **zero value are omitted**. Example: `"1 minute and 0 seconds"` should just be `"1 minute"`.
- Units must be used **as much as possible**:
    - `61 seconds` should be `"1 minute and 1 second"` not `"61 seconds"`.

## Summary

Write a PHP function that:
- Accepts a non-negative integer (number of seconds)
- Returns a human-readable duration string
- Follows all formatting and grammatical rules as described above
